pipeline {
    agent any

    environment {
        DEV_SERVER  = "ubuntu@172.31.19.114"
        PROD_SERVER = "ubuntu@172.31.19.115"
        APP_DIR     = "/var/www/html"
    }
stages{
    stage('Deploy to DEV') {
    steps {
        sh '''
        # Clean old files
        ssh $DEV_SERVER "sudo rm -rf $APP_DIR/*"

        # Copy files to temp directory
        scp -r index.html style.css $DEV_SERVER:/tmp/

        # Move files to Apache directory with sudo
        ssh $DEV_SERVER "sudo mv /tmp/index.html /tmp/style.css $APP_DIR/"

        # Fix ownership
        ssh $DEV_SERVER "sudo chown -R www-data:www-data $APP_DIR"

        # Restart Apache
        ssh $DEV_SERVER "sudo systemctl restart apache2"
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
                scp -r index.html style.css $PROD_SERVER:$APP_DIR/
                ssh $PROD_SERVER "sudo chown -R www-data:www-data $APP_DIR"
                ssh $PROD_SERVER "sudo systemctl restart apache2"
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
