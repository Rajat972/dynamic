pipeline {
    agent any

    environment {
        DEV_SERVER  = "ubuntu@172.31.19.114"
        PROD_SERVER = "ubuntu@172.31.21.91"
        APP_DIR     = "/var/www/html"
    }

    stages {

        stage('Deploy to DEV') {
            steps {
                sh '''
                ssh $DEV_SERVER "sudo rm -rf $APP_DIR/*"

                scp -r index.html style.css submit.php db.php $DEV_SERVER:/tmp/

                ssh $DEV_SERVER "sudo mv /tmp/index.html /tmp/style.css /tmp/submit.php /tmp/db.php $APP_DIR/"

                ssh $DEV_SERVER "sudo chown -R www-data:www-data $APP_DIR"
                ssh $DEV_SERVER "sudo chmod 644 $APP_DIR/*.php"

                ssh $DEV_SERVER "sudo systemctl restart nginx"
                '''
            }
        }

        stage('Approval for PROD') {
            steps {
                input message: 'Approve deployment to PROD?', ok: 'Deploy'
            }
        }

        stage('Deploy to PROD') {
            steps {
                sh '''
                ssh $PROD_SERVER "sudo rm -rf $APP_DIR/*"

                scp -r index.html style.css submit.php db.php $PROD_SERVER:/tmp/

                ssh $PROD_SERVER "sudo mv /tmp/index.html /tmp/style.css /tmp/submit.php /tmp/db.php $APP_DIR/"

                ssh $PROD_SERVER "sudo chown -R www-data:www-data $APP_DIR"
                ssh $PROD_SERVER "sudo chmod 644 $APP_DIR/*.php"

                ssh $PROD_SERVER "sudo systemctl restart nginx"
                '''
            }
        }
    }

    post {
        success {
            echo "✅ Deployment completed successfully!"
        }
        failure {
            echo "❌ Deployment failed!"
        }
    }
}
