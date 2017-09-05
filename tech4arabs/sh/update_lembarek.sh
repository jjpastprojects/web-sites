lembarek=/opt/lampp/htdocs/packages/lembarek

cd /opt/lampp/htdocs/tech4arab/vendor/lembarek

for package in `ls $lembarek`
do
    echo "updatin $package ..."
    git clone file:////$lembarek/$package
done

