#!/usr/bin/env bash

set -eu

readonly DOCKER_APPLICATION_CONTAINER_NAME=3olen-phpunit-tp-application
readonly DOCKER_COMPOSER_CONTAINER_NAME=3olen-phpunit-tp-composer
readonly DOCKER_PHPUNIT_CONTAINER_NAME=3olen-phpunit-tp-tests

title() {
    echo -e "\n\e[1;34m${1}\e[0m"
}
error() {
    echo -e "\n\e[1;31m${1}\e[0m"
}

run_docker_composer() {
  arg_command="composer"
  if [[ ! -z "${1:-}" ]]; then
    arg_command="${arg_command} $@"
  fi

  title "Exécution de composer dans le container ${DOCKER_COMPOSER_CONTAINER_NAME}..."

  run_docker "${DOCKER_COMPOSER_CONTAINER_NAME}" "composer:latest" "${arg_command}"
}

run_docker_application() {
  arg_command="php application"
  if [[ ! -z "${1:-}" ]]; then
    arg_command="${arg_command} $@"
  fi

  title "Exécution de l'application console dans le container ${DOCKER_APPLICATION_CONTAINER_NAME}..."

  run_docker "${DOCKER_APPLICATION_CONTAINER_NAME}" "php:8.3" "${arg_command}"
}

run_docker_phpunit() {
  arg_command="phpunit"
  if [[ ! -z "${1:-}" ]]; then
    arg_command="${arg_command} $@"
  fi

  title "Exécution de phpunit dans le container ${DOCKER_PHPUNIT_CONTAINER_NAME}..."

  run_docker "${DOCKER_PHPUNIT_CONTAINER_NAME}" "php:8.3" "${arg_command}"
}

run_docker() {
  title "Exécution de la commande « ${3} »..."
  docker \
      run \
          --rm \
          --interactive \
          --tty \
          --name "${1}" \
          --volume "${ROOT_PATH}":/app \
          --workdir /app \
          --user $(id -u):$(id -g) \
          ${2} \
          ${3}
}
