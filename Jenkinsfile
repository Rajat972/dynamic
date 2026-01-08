pipeline {
    agent any

    environment {
        DEV_SERVER = "ubuntu@172.31.19.114"
        APP_DIR = "/var/www/html"
    }

    stages {

        stage('Deploy to DEV') {
            steps {
                sh """
                ssh $DEV_SERVER 'sudo rm -rf $APP_DIR/*'
                scp -r * $DEV_SERVER:$APP_DIR/
                ssh $DEV_SERVER 'sudo systemctl restart apache2'
                """
            }
        }
    }
}
