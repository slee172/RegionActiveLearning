# add our app to the system path
import sys
sys.path.insert(0, "/var/www/html/predict-rest-api")

# import the application and away we go...
from run_web_server import app as application
