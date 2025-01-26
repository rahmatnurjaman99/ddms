FROM dunglas/frankenphp

# add additional extensions here:
RUN install-php-extensions \
    pdo \
	# pdo_pgsql \
	# pgsql \
	gd \
	intl \
	zip \
	opcache