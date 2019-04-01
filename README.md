## Standalone selenium with facebook webdriver

**To start the server:**
``java -jar selenium-server-standalone-3.14.0.jar -port [port_number]`` 

### First draft
 #### Works with **chromedriver** and **firefox's geckodriver**.
 But make sure you copy the binaries under ``/usr/local/bin/[driver_name]`` 
 The driver files are for linux systems.

 To install them for OSX or Windows follow the appropriate installation guides.

 [Chromedriver download](http://chromedriver.chromium.org/downloads)
 [Chromedriver download](https://github.com/mozilla/geckodriver/releases)

**TODO:**
- 
- Creat a better phpunit.xml config file
- Create better scaffolding
- Create helper methods to abstract the verbose webdriver function names
- Create tests to run for each browser driver
