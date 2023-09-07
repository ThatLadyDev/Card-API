phpinsights:
	./vendor/bin/phpinsights

phpstan:
	vendor/bin/phpstan analyse app/

.PHONY: phpinsights phpstan
