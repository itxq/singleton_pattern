<?php
/**
 *  ==================================================================
 *        文 件 名: SingletonPattern.php
 *        概    要: 单例设计
 *        作    者: IT小强
 *        创建时间: 2019-03-05 20:35:00
 *        修改时间: 2019-05-03 16:31:00
 *        copyright (c) 2016 - 2019 mail@xqitw.cn
 *  ==================================================================
 */

namespace itxq\kelove\traits;

/**
 * 单例设计
 * Trait SingletonPattern
 * @package kelove\traits
 */
trait SingletonPattern
{
    /**
     * @var array - 实例
     */
    protected static $instances = [];
    
    /**
     * @var array - 配置信息
     */
    protected $config = [];
    
    /**
     * @var mixed - 反馈信息
     */
    protected $message = '';
    
    /**
     * SingletonPattern 构造函数. 禁止直接实例化该类
     * @param array $config - 配置信息
     */
    protected function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initialize();
    }
    
    /**
     * @title 初始化加载
     * @author IT小强
     * @createTime 2019-03-05 20:56:55
     */
    protected function initialize(): void
    {
    }
    
    /**
     * @title 单利模式 - 返回本类对象
     * @param array $config - 配置信息
     * @param bool $force - 是否强制重新实例化
     * @return static
     * @author IT小强
     * @createTime 2019-03-05 20:40:34
     */
    public static function make(array $config = [], bool $force = false)
    {
        $className = static::class;
        if ($force === true || !isset(self::$instances[$className]) || !self::$instances[$className] instanceof $className) {
            $instance = new $className($config);
            self::$instances[$className] = $instance;
        }
        return self::$instances[$className];
    }
    
    /**
     * @tile 设置配置
     * @param string|array $key 配置项名称
     * @param mixed $value 配置项值
     * @return static
     * @author IT小强
     * @createTime 2019-03-05 20:37:37
     */
    public function setConfig($key, $value = null)
    {
        if (is_array($key)) {
            $this->config = array_merge($this->config, $key);
        } else {
            $this->config[$key] = $value;
        }
        return self::$instances[static::class];
    }
    
    /**
     * @title 获取配置信息
     * @param string $key 为空获取全部配置信息
     * @param null $default 默认值
     * @return array|mixed
     * @author IT小强
     * @createTime 2019-03-30 10:46:49
     */
    public function getConfig(string $key = '', $default = null)
    {
        if (empty($key)) {
            return $this->config;
        }
        return $this->config[$key] ?? $default;
    }
    
    /**
     * @title 获取反馈信息
     * @return mixed
     * @author IT小强
     * @createTime 2019-03-05 20:39:55
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @title 克隆防止继承
     * @author IT小强
     * @createTime 2019-03-05 20:39:41
     */
    final private function __clone()
    {
    
    }
}
