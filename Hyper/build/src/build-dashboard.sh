cd dashboard;

npm i

npm run build

cd ../

cp -r dashboard/build build/dashboard

cd build/dashboard || echo "Directory not found!"

