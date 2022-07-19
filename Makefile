
VERSION=$(date +%Y%m%d)
LISTEN_PORT=8080

include .env

IMAGE_LATEST=$(IMAGE_NAME):latest
IMAGE_VERSION=$(IMAGE_NAME):$(VERSION)

build:
	docker build -t $(IMAGE_LATEST) .
	docker tag $(IMAGE_LATEST) $(IMAGE_VERSION)
push: build
	docker push $(IMAGE_LATEST)
	docker push $(IMAGE_VERSION)
serve: build
	docker run --rm -it -p $(LISTEN_PORT):$(LISTEN_PORT) -e LISTEN_PORT=$(LISTEN_PORT) $(IMAGE_VERSION)
run: build
	docker run --rm -it -p $(LISTEN_PORT):$(LISTEN_PORT) -e LISTEN_PORT=$(LISTEN_PORT) $(IMAGE_VERSION) sh
