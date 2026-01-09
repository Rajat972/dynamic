pipeline {
    agent any

    environment {
        DEV_SERVER = "ubuntu@172.31.19.114"   // your EC2 private IP or public IP
        APP_DIR    = "/var/www/html"
    }

stages{

    stage{"deploy to dev"}{
     steps{
         sh'''
         ssh $DEV_SERVER "sudo rm -rf $APP_DIR/*"
         scp -r index.html style.css $DEV_SERVER:$APP_DIR/
         ssh $DEV_SERVER "sudo chown -R www-data:www-data $APP_DIR"
         ssh $DEV_SERVER "sudo systemctl restart apache2"

         '''
     }
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
