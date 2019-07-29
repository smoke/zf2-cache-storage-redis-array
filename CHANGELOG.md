# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.2.0 - 2019-07-29

### Added

- [#6](https://github.com/smoke/zf2-cache-storage-redis-array/pull/6) PSR-16 & PSR-6 support with integration unit tests provided by [cache/integration-tests](https://github.com/php-cache/integration-tests)

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#4](https://github.com/smoke/zf2-cache-storage-redis-array/pull/4) On every `RedisArray::getResource` call, `RedisArray` requested an `INFO` call to redis to receive the version. This led to unnecessary `INFO` calls on every other call made to redis. **Thanks to @CyberLine** 

## 1.1.1 - 2018-09-07

### Added

- Synchronized `Redis` adapter capabilities from `zend-cache` with `RedisArray` adapter. The `RedisArray` Adapter now can handle `serializer` options and thefore serialize objects and arrays as well.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- The `RedisArray` created capaibilities with calling `Capabilities::setExpiredRead` with false, which is deprecated by `zend-cache` and resetted the `staticTtl` value to false, which is in fact incorrect.

### Fixed

- [#2](https://github.com/smoke/zf2-cache-storage-redis-array/pull/2) `RedisResourceManager::getMajorVersion` returned invalid value, if the resource was never used before.

## 1.1.0 - 2018-08-28

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [#1](https://github.com/smoke/zf2-cache-storage-redis-array/pull/1) removed support for PHP 5.3 and PHP 5.4 since these versions already reached their EOL in 2014 and 2015.

### Fixed

- [#1](https://github.com/smoke/zf2-cache-storage-redis-array/pull/1) fixes possible `null pointer` exceptions when calling methods which depend on the `RedisArrayResourceManager` which might not be initialized to that point.  

## 1.0.2 - 2014-07-09

### Added

- `ext-redis` as dependency to `composer.json`

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.0.1 - 2014-07-09

Improve `README.md` and License info

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.0.0 - 2014-07-09

Initial version of smoke/zf2-cache-storage-redis-array

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
