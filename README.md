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


2. Run these commands
        $ php artisan key:generate
        $ php artisan migrate
        $ composer require dusterio/lumen-passport

3. Check your database and see the result, 
   you can now host this api using virtual host or you can use the terminal and run $ php -S localhost:8000 -t ./public 

4. using your favorite REST Client test these URI

    4.1 http://[your-domain]/api/register
        
        form_params: first_name, last_name, email, password, address, status
        
        Note: Feel free to change the fields of user table simply by using php migration, check more details on Laravel/ lumen documentaion.
    
    4.2  http://[your-domain]/api/login
    
         form_params: username, password
         
         Yey! access token has been granted.
         
       
    4.3   http://[your-domain]/api/logout
    
          Header Authentication: Bearer [granted access token]
    
          Note: these access tokens and refresh will be deleted on the database once logged out, I prefer to delete these tokens than to use the revoke method.
        
 5. You can now use this app as a start-up, to authenticate your routes and secure you api. Feel free to check the codes, it is not          the best but you can use it to create a lumen app with lumen passport already installed.
    

        
