<?php
if(PHP_SAPI != 'cli')
{
    exit;
}

try
{
    if( ! file_exists( __DIR__ . '/../aams-config.yml' ) )
    {
        throw new Exception(__DIR__ . '/aams-config.yml 不存在');
    }

    require_once "spyc.php";

    $yaml = Spyc::YAMLLoad( __DIR__ . '/../aams-config.yml' );

    if( ! $yaml )
    {
        throw new Exception('aams-config.yml 內容錯誤');
    }

    $projectVolumes = '';

    $nginxVolumes = '';

    $ymlContent = file_get_contents(__DIR__ . '/docker-compose-base.yml');

    // auto mount project directory
    if( isset($yaml['services']['autoload_projects']) && $yaml['services']['autoload_projects'] )
    {
        $dirs = array_filter(glob(__DIR__ . '/../../*',GLOB_MARK), 'is_dir');

        foreach( $dirs as $projectPath )
        {
            $destination = basename($projectPath);

            if( $destination == 'docker/' )
            {
                continue;
            }

            $projectVolumes = $projectVolumes . ( $projectVolumes == ""? "- ": "        - ") . $projectPath . ':' . '/var/www/html/' . $destination . "\n";
        }
    }

    // specify mount project directory
    if( isset($yaml['services']['projects']['project_path']) )
    {
        foreach( $yaml['services']['projects']['project_path'] as $projectPath )
        {
            $destination = basename($projectPath);

            $projectVolumes = $projectVolumes . ( $projectVolumes == ""? "- ": "        - ") . $projectPath . ':' . '/var/www/html/' . $destination . "\n";
        }
    }

    $ymlContent = str_replace( '{{PROJECT_VOLUMES}}', $projectVolumes, $ymlContent);

    // mount nginx conf
    if( isset( $yaml['services']['nginx']['conf_path'] ) )
    {
        $nginxConfRule = $yaml['services']['nginx']['conf_path'];

        foreach( $nginxConfRule as $confRule )
        {
            $confs = glob( __DIR__ . '/../' . $confRule);

            foreach( $confs as $conf )
            {
                $nginxVolumes = $nginxVolumes . ( $nginxVolumes == ""? "- ": "        - ") . $conf . ':' . '/etc/nginx/conf.d/' . basename($conf) . "\n";
            }
        }
    }

    $ymlContent = str_replace( '{{NGINX_VOLUMES}}', $nginxVolumes, $ymlContent);

    file_put_contents( __DIR__ . '/../docker-compose.yml', $ymlContent);

}
catch( \Exception $e )
{
    echo $e->getMessage();
}