cd mobile-app;

npm i

npm run build

cd ../

cp -r mobile-app/build build/mobile-app

cd build/mobile-app || echo "Directory not found!"

