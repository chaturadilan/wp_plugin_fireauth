 #!/bin/bash

composer install --no-dev --optimize-autoloader
rm -rf dist
mkdir dist
zip -r dist/fireauth.zip  .  -x "README.md"  -x "package.sh" -x "composer.json" -x "composer.lock" -x "*.DS_Store" -x ".idea/*" -x "dist/*"  -x ".git/*"  -x ".gitignore"