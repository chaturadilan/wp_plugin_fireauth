 #!/bin/bash

 zip -r dist/wp-fireauth.zip . -x "composer.json" -x "composer.lock" -x "*.DS_Store" -x "dist/*"  -x ".gitignore"