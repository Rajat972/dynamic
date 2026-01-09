pipeline {
    agent any

    environment {
        DEV_SERVER = "ubuntu@172.31.19.114"   // your EC2 private IP or public IP
        PROD_SERVER = "ubuntu@172.31.19.115"
        APP_DIR    = "/var/www/html"
    }

    stages {

        stage('Deploy to EC2') {
            steps {
                sh '''
                ssh $DEV_SERVER "sudo rm -rf $APP_DIR/*"
                scp -r index.html style.css $DEV_SERVER:$APP_DIR/
                ssh $DEV_SERVER "sudo chown -R www-data:www-data $APP_DIR"
                ssh $DEV_SERVER "sudo systemctl restart apache2"
                '''
            }
            stage{"approval for prod"}
            {
                steps{
                    input message: 'approve for prod?', ok: 'Deploy'
        }
                stage {"prod deploy"}
                {
                    sh'''
                ssh $PROD_SERVER "sudo rm -rf $APP_DIR/*" 
                scp -r index.html style.css $PROD_SERVER:$APP_DIR/
                ssh $PROD_SERVER "sudo chown -R www-data:www-data $APP_DIR"
                ssh $PROD_SERVER "sudo systemctl restart apache2"
                '''
    }
            }

    post {
        success {
            echo "✅ Website deployed successfully!"
        }
        failure {
            echo "❌ Deployment failed!"
        }
    }
}
    }
