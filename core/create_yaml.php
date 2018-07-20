<?php
if(PHP_SAPI != 'cli')
{
    exit;
}

define( 'ROOT_PATH', __DIR__ . '/..');

try
{
    if( ! file_exists( ROOT_PATH . '/aams-config.yml' ) )
    {
        throw new Exception(ROOT_PATH . '/aams-config.yml 不存在');
    }

    require_once "spyc.php";

    $yaml = Spyc::YAMLLoad( ROOT_PATH . '/aams-config.yml' );

    if( ! $yaml )
    {
        throw new Exception('aams-config.yml 內容錯誤');
    }

    $projectVolumes = '';

    $nginxVolumes = '';

    $ymlContent = file_get_contents( ROOT_PATH . '/template/docker-compose-template.yml' );

    // auto mount project directory
    if( isset($yaml['services']['autoload_projects']) && $yaml['services']['autoload_projects'] )
    {
        $dirs = array_filter(glob(ROOT_PATH . '/../*',GLOB_MARK), 'is_dir');

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
//            $destination = basename($projectPath);
//
//            $projectVolumes = $projectVolumes . ( $projectVolumes == ""? "- ": "        - ") . $projectPath . ':' . '/var/www/html/' . $destination . "\n";

            $projectVolumes = $projectVolumes . ( $projectVolumes == ""? "- ": "        - ") . $projectPath . "\n";
        }
    }

    $ymlContent = str_replace( '{{PROJECT_VOLUMES}}', $projectVolumes, $ymlContent);

    // mount nginx conf
    if( isset( $yaml['services']['nginx']['conf_path'] ) )
    {
        $nginxConfRule = $yaml['services']['nginx']['conf_path'];

        foreach( $nginxConfRule as $confRule )
        {
            if( substr( $confRule, 0, 1) === "/" )
            {
                $confs = $confRule;
            }
            else
            {
                $confs = glob( ROOT_PATH . '/' . $confRule);
            }

            foreach( $confs as $conf )
            {
                $nginxVolumes = $nginxVolumes . ( $nginxVolumes == ""? "- ": "        - ") . $conf . ':' . '/etc/nginx/conf.d/' . basename($conf) . "\n";
            }
        }
    }

    $ymlContent = str_replace( '{{NGINX_VOLUMES}}', $nginxVolumes, $ymlContent);

    file_put_contents( ROOT_PATH . '/docker-compose.yml', $ymlContent);

}
catch( \Exception $e )
{
    echo $e->getMessage();
}