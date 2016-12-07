all:

install:
	mkdir build
	composer install
	cp -R vendor build/
	cp index.php build/
	tar -zcf build.tar.gz build
	rm -rf build/

clean:
	rm -rf build/ build.tar.gz composer.lock vendor/ cache
	
.PHONY: clean install all
