package=$1

lembarek=/opt/lampp/htdocs/packages/lembarek

cd /opt/lampp/htdocs/tech4arab/vendor/lembarek

rm -R $package

echo "updatin $package ..."

git clone file:////$lembarek/$package
