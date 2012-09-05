<?php

/**
 * Top平台组件
 * 
 * @author likai
 */
class Top extends CApplicationComponent
{
	
    /**
     * 淘宝联盟（阿里妈妈）PID
     * 
     * @var string
     */
    public $pid;
    
	/**
	 * 淘宝开放平台 API 接口 App Key
	 * 
	 * @var string
	 */
	public $appkey;
	
	/**
	 * 淘宝开放平台 API 接口 App Secret
	 * 
	 * @var string
	 */
	public $secretKey;
	
    /**
     * 数据返回格式
     * 
     * @var string
     */
	public $format;
	
	/**
	 * TopClient instance
	 * 
	 * @var TopClient
	 */
    private $_client;
    
    
    /**
     * 初始化TopClient参数
     * 
     * @see CApplicationComponent::init()
     */
    public function init()
    {
        parent::init();
        $this->_client = new TopClient();
		$this->_client->appkey = $this->appkey;
		$this->_client->secretKey = $this->secretKey;
		$this->_client->format = $this->format;
    }
    
    /**
     * 调用对应TopClient方法
     * 
     * @see CComponent::__call()
     */
    public function __call($name, $parameters)
    {
        if(method_exists($this->_client, $name))
            return call_user_func_array(array($this->_client, $name), $parameters);
		return parent::__call($name, $parameters);
    }
    
    public function processResponse($response)
    {
        if (is_object($response))
            $response = get_object_vars($response);
        return is_array($response) ? array_map(array($this, __FUNCTION__), $response) : $response;
    }
}