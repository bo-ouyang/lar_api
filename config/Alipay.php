<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2021001140675213",

    //商户私钥，您的原始格式RSA私钥
    'private_key' => "MIIEowIBAAKCAQEAk8+DI5wzzkB3F0qt440MGzPof+FC2ETVD/oPY7qs4GkQpvzdNLqkjlZDh3L/e6u3pffLJ3j0I3hd6h0hKc4u0NVccZscTL8vgWImD8B7mouVxYCyr4McfBdKokNCn/h6fBGZrjWs8Iwb2V6Laj0ZBJvVVBGxDnXwFYGMs6H7PTQpbMB98jCog2JkB87TnZc/57OGR0b+3TlV+PW4oaO7dA0UHKkEMjcjQJzHakFEDdIyCpnoZjgZQDiMmsCj6P52pzyFUmxvQEuxX3+KkTRQPt1mKQG0zGU09VKgPtCq4afaQkHRquQlhxlLnJWfFB7aFizyK5HJH0YI0Qp3uPeTrQIDAQABAoIBAGLNH+yKufpRDwnrqkZjfsckMHJigYsMn5rZXLYeDvbGZBIrDjXz2JEoSmVc0je5db2j4BEXgaHAEI6wP/2wy4xeQjfSJd2LIlcK40Q+NqD8UvW87DPzoPO1ofbKnNtPfZg3L5HKYTo9fVQUJX6zLmjtPXC/jqmK3huSCBn+2XBzy1X2Xo1joVSAqRt5ExnhOmo1F3BbNomdjRtp2aa37BxsCfzCPVT+eO+GRUKLboXWjgsUxeKQJDSg0HHaZ1TkO4t9sR9kcr0SGRWXFvYlAVybtnK2W8dXhf2KN04/3GSwMAmUEhow+e+FhvdOqilUrKGtfMHTlxXfWt1oy/NoPeUCgYEA1aNiaXNrESnkamcjjYcMTv69lzmfz1PGXAKq4ZdjAkMMPFeTOivUM6you1hOQ/rYpQ9pSW9V453nVzsdEI2zlHJoeIP7Qy1z4KTc7bVOOPdIp53Mw9KR/xNFu2szSYp6zp0AAbd7Im7Ry6VhnlwFR/saMynjPSh/7pEV8aOzIiMCgYEAsR6c6mRVVslNRmihssEKOrQBxQQisgHF02egpnOFG9U/qVYKJFP7VkzwJQ2yXIiLyvl6kB0Ar7Tz+dC8NklKTvGfgTP5m2Cx/kcOIr1KAWoQoIQJnkUmaaunqY/QWKLJIqjrpyjSfIJFjo8BFTmhBlTSNFk52iPKwXjSxI1hR+8CgYA6h6e3okJsEmEc8aLg7GXn4ozIuKXa5GXM4YI1igc7IGliws94OXfKrHwRz7CpmTjvh9hdoR4T3Tf7QxvEZD4V5n5OvkIBdptvqVtJ2MlUfBMwsN/fqnoLOxl4rnb/p+vbXVIaJk2a8meR9n5XJ3je7qGP8OLr54OdNaygZiv2pwKBgQCTVOasJufB+FMaVWDkI6WRrTinnMgLkGPxdYrxyrgXrex1vIdVLrKsV/WOrPUH+eFm5t1n0WhHwFsOG+7jrVVtk5ndzNE9yVJmNM7yYMiVopfQHeUuTVElp08hQerKQCbVePQFKXTlcyvO6O+6qyRh8t6kAvCXnxxCkXGpY/1e6wKBgAdSoLEblc7tn2sJr9HTfKxfDmDBW4WM5NMB5eiR6RJDJ31x3uETXEyTE2M8r5MV+/PKdvdsyzX9AsemRyGpyTcmMlLQ25o1d0zBsKJySY+lr9OUuYRoBIhsLn4ifeaUf5ClxXta87yVsrE8Yl7qLkonrzoMFgbTvVp0Rzb+0Dra",

    //异步通知地址
    'notify_url' => "https://api.ouyang.wiki/aliNotify",

    //同步跳转
    'return_url' => "https://api.ouyang.wiki/Alireturns",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAk6vh1RgSD2etpRQpTZUC+2dfs/Qj2XiM6ua3ksS7OCqeSgkSsL7ZLmrY+ajE5mUaRrkJRZf0XdfQpsTppCUcsiuN03sOwnbqhzTEygMKGtur5m2WZ77eK7sVmNPByfMX1iJGgxGfyJtF3iz26C6UCSMnS+JYCkzzacd/OQyJStg7a3NekO+TlwLpqJh0YuVJLNKecQ8OIyiAEllljLM0nk2CR/1docqqKivgyGgJp8fDTQsyz5mVUyVtxeQ2xOduLwH+WD/E57SClbTv++xfnbg4mexdn6PSZ8OSnDJO60mU0NNcy/o9udmPPUx0PcRdNlyk5T3KACfLwMK9BqYbdQIDAQAB",


];