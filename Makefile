phpinsights:
	./vendor/bin/phpinsights

phpstan:
	vendor/bin/phpstan analyse

.PHONY: phpinsights phpstan
