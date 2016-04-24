Framework :Symfony Standard Edition
========================

This App is made based on Symfony2 Framework Edition

Steps: 

01) first Install using composer:
    composer install

02) to try the API 
    php app/console server:run
    access the API documnets via http://127.0.0.1:8000/api/doc
    for information about the below APIs methods:
        /api/date/{date}
        /api/days/{year}/{term}
        /api/name/{year}
        /api/name/{year}/{term}
        /api/terms/{year}
    Data source for the API is found in src/AppBundle/Resources/data2.yml

03) For CLI use the following command:
    php app/console academic:search [date] [file_location]
    
    Example
        php app/console academic:search 2016-02-05 c:\data2.yml
              >  Date belongs to academic year 2015/16
              >  Academic year contains the following terms:
                    >>  Autumn 2015/16 (98 days)
                    >>  Spring 2015/16 (103 days)