year=`date +%Y`

generate: download-insee
	@for type in region department city ; do \
		for format in sql yaml ; do \
			php app/console french-geography:generate $$type $$format insee /tmp/insee_$$type.txt data/$$type.$$format; \
		done \
	done

download-insee:
	@wget --quiet http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/$(year)/txt/reg$(year).txt -O /tmp/insee_region.txt
	@echo "File downloaded in /tmp/insee_region.txt"
	@wget --quiet http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/$(year)/txt/depts$(year).txt -O /tmp/insee_department.txt
	@echo "File downloaded in /tmp/insee_department.txt"
	@wget --quiet http://www.insee.fr/fr/methodes/nomenclatures/cog/telechargement/$(year)/txt/comsimp$(year).zip -O /tmp/insee_city.zip
	@unzip -q -d /tmp /tmp/insee_city.zip && rm /tmp/insee_city.zip && mv /tmp/comsimp$(year).txt /tmp/insee_city.txt
	@echo "File downloaded in /tmp/insee_cities.txt"
