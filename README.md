# Lumen_authentication

Installation

1. Create a new database.
2. Add a new file '.env', paste the list below and supply your database credentials:

            APP_ENV=local
            APP_DEBUG=true
            APP_KEY=base64:
            APP_TIMEZONE=UTC
            API_PREFIX=api

            LOG_CHANNEL=stack
            LOG_SLACK_WEBHOOK_URL=

            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=[database]
            DB_USERNAME=[user name]
            DB_PASSWORD=[password]

            CACHE_DRIVER=file
            QUEUE_DRIVER=sync


            CACHE_DRIVER=array
            QUEUE_DRIVER=sync


            PASSPORT_LOGIN_ENDPOINT=http://[your domain]/oauth/token
            PASSPORT_CLIENT_ID= [leave it blank for a while]
            PASSPORT_CLIENT_SECRET= [leave it blank for a while]
            SMS_KEY = [SMS gateway key]
            SMS_DEVICE_ID = [sms gateway device id]
            
3. Run these commands.

            $ composer install
            $ php artisan key:generate
            $ php artisan migrate
            $ php artisan passport:install
            
            Check your database and see the result, go to oauth_clients table, edit .env and use oauth clients id and secret

            PASSPORT_LOGIN_ENDPOINT=http://[your domain]/oauth/token
            PASSPORT_CLIENT_ID= [oauth_clients->id]
            PASSPORT_CLIENT_SECRET= [oauth_clients->secret]
            DO_NOT_USE = Y0U!RN0TW3LC0M3

            SMS_KEY = [SMS gateway key]
            SMS_DEVICE_ID = [sms gateway device id]

4.  This app can now be hosted or  run $ php -S localhost:8000 -t ./public to test your app.


5. Using your favorite REST Client test these URI

http://[your-domain]/api/register
        
        form_params: first_name, last_name, email, password, address, status
        
        Note: Feel free to change the fields of user table simply by using php migration, check more details on Laravel/ lumen documentaion.
http://[your-domain]/api/login
    
         form_params: username, password
         
         Yey! access token has been granted.
         
http://[your-domain]/api/logout
    
          Header Authentication: Bearer [granted access token]
    
          Note: these access tokens and refresh will be deleted on the database once logged out, I prefer to delete these tokens than to use the revoke method.
        
 6. You can now use this app as a start-up, to authenticate your routes and secure you api. Feel free to check the codes, it is not          the best but you can use it to create a lumen app with lumen passport already installed.
    
NOTE: Use virtual hosting instead of using php artisan serve 
        
