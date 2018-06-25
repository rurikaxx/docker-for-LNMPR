# 本機docker環境建置教學

## 一.設定aams-config.yml(請參考aams-config.yml.example)

yml說明:

    services:    
      autoload_projects: true
      nginx:
          conf_path:
            - ../mamaba/docker/nginx/conf/*.conf
            - ../business/nginx/conf/*.conf    
      projects:
          project_path:
            - ../mamaba:/var/www/html/mamaba
            - ../business:/var/www/html/business
   
autoload_projects : 是否自動mount pjojects目錄

nginx - conf_path : 指定nginx設定檔位置,會將指定檔案mount至nginx container的/etc/nginx/con.f/目錄下

projects - project_path : 指定project位置,會將指定目錄mount至nginx container的/var/www/html/目錄下

### 二.建立 + 啟動 nginx + php + redis + mysql + phpmyadmin
1.執行./env.sh

2.輸入 1, 開始建置/啟動 nginx + php + mysql + redis + phpmyadmin 的 containers