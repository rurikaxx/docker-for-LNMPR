#!/bin/bash

# 切換到 evn.sh 檔案目錄底下
BASEDIR=$(dirname "$0")
cd "$BASEDIR"

clear

while :
do
    response=`php -f ./base/create_yaml.php`

    if [ "$response" != "" ]; then
        echo '錯誤: ' . $response
        exit
    fi

    # 選擇要啟動的系統
    echo "Choose the containers you want to start:"
    echo "----------------------------------------"
    echo "1. Nginx + PHP + PKG-PHP + MySQL + PHPMyAdmin + Redis"
    echo "c. Close all containers"
    echo "l. List all containers"
    echo "q. Exit"
    echo "----------------------------------------"
    echo "s. Start specific server"
    echo "d. Shutdown specific server"
    echo "r. Restart specific server"
    echo "  - php"
    echo "  - pkg-php"
    echo "  - nginx"
    echo "  - mysql"
    echo "  - phpmyadmin_mysql"
    echo "  - redis"
    echo "----------------------------------------"
    read -p "Input:" input input2

    clear

    case $input in
        1)
            # 啟動 php
            docker-compose up -d --build php
            # 啟動 nginx
            docker-compose up -d --build nginx
            # 啟動 mysql
            docker-compose up -d --build mysql
            # 啟動 phpmyadmin
            docker-compose up -d --build phpmyadmin_mysql
            # 啟動 redis
            docker-compose up -d --build redis

            ;;
        s)
            # 啟動指定的服務
            if [  "$input2" == "" ]; then
                echo "which service do you want to start?"
            else
                docker-compose up -d --build $input2
            fi
            ;;
        d)
            # 關閉指定的服務
            if [  "$input2" == "" ]; then
                echo "which service do you want to shutdown?"
            else
                docker rm -f $input2
            fi
            ;;
        r)
            # 關閉指定的服務
            if [  "$input2" == "" ]; then
                echo "which service do you want to restart?"
            else
                docker rm -f $input2
                docker-compose up -d --build $input2
            fi
            ;;
        l)
            # 查看目前的 container
            docker ps -a
            ;;
        c)
            # 關閉透過 docker-compose 產生的 container
            docker-compose down
#            docker rm -f php
#            docker rm -f nginx
#            docker rm -f mysql
#            docker rm -f phpmyadmin_mysql
#            docker rm -f redis
            ;;
        *)
            # 離開程序
            exit
            ;;
    esac
done