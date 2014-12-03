generate: download-insee
	@for type in region department city ; do \
		for format in sql yaml ; do \
			php app/console french-geography:generate $$type $$format insee /tmp/insee_$$type.txt data/$$type.$$format; \
		done \
	done

download-insee:
	@wget http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/2014/txt/reg2014.txt -O /tmp/insee_region.txt
	@echo "File downloaded in /tmp/insee_region.txt"
	@wget http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/2014/txt/depts2014.txt -O /tmp/insee_department.txt
	@echo "File downloaded in /tmp/insee_department.txt"
	@wget http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/2014/txt/comsimp2014.zip -O /tmp/insee_city.zip
	@unzip -d /tmp /tmp/insee_city.zip && rm /tmp/insee_city.zip && mv /tmp/comsimp2014.txt /tmp/insee_city.txt
	@echo "File downloaded in /tmp/insee_cities.txt"
