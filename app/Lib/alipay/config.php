<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2021001140675213",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAoee7cnf5zNtF2bBWIo0NPho+FYEw83HR+DK4woJZAYSZztWfV4PH//RZTcQp4bgGUkavKQVtAczc9aOJ1udhp/j1SvTVgsGoYTrorcmRPlz7l0UYf3276kEcgniUqpgE/gID8rfdsNP0aOsKJd3nFYkAZWAd1tCBjWGMOrrDoBR8CXnyr7Rbvar2p/sQ7KKIwhoz7aSEiurn9Rs7EtAnue40PzKLuj2OBGdDLmFlfoqBqVJk3ODKiQOnURfVARfm7mdIUXbX7Syk3WRB9/vSszXERNjXFYlv/VINiCQqFJB4muMtivSwdfUiNDw1kdB4VCDlNykdRrhg04Vazc4AXQIDAQAB",
		
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
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAk6vh1RgSD2etpRQpTZUC+2dfs/Qj2XiM6ua3ksS7OCqeSgkSsL7ZLmrY+ajE5mUaRrkJRZf0XdfQpsTppCUcsiuN03sOwnbqhzTEygMKGtur5m2WZ77eK7sVmNPByfMX1iJGgxGfyJtF3iz26C6UCSMnS+JYCkzzacd/OQyJStg7a3NekO+TlwLpqJh0YuVJLNKecQ8OIyiAEllljLM0nk2CR/1docqqKivgyGgJp8fDTQsyz5mVUyVtxeQ2xOduLwH+WD/E57SClbTv++xfnbg4mexdn6PSZ8OSnDJO60mU0NNcy/o9udmPPUx0PcRdNlyk5T3KACfLwMK9BqYbdQIDAQAB",
		
	
);