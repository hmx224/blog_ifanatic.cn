<?php

namespace App\Providers;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //转换时间格式
        Carbon::setLocale('zh');
        //字段限制长度
        Schema::defaultStringLength(191);
        //监听sql
        $log_config = env('LOG_SAVE', 'false');
        if ($log_config) {
            //监听sql语句并写入日志
            DB::listen(function ($sql) {
                // var_dump($sql->bindings);
                //Log::info($sql->sql);

                foreach ($sql->bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if (is_string($binding)) {
                            $sql->bindings[$i] = "'$binding'";
                        }
                    }
                }
                // Insert bindings into query
                $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);

                $query = vsprintf($query, $sql->bindings);

                // Save the query to file
//                Log::info("SQL:", array($query));

                // Save the query to file
                //创建文件，并修改权限,查询sql运行写入到当天的日志中
                $logFile = fopen(
                    storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'),
                    'a+'
                );
                $file_info = fread($logFile, "10");
                \Log::info('log文件里面获取的：' . $file_info . '_query.log');
                if (empty($file_info)) {
                    \Log::info('chmod 777 ' . storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'));
                    exec('chmod 777 ' . storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'));
                }

                fwrite($logFile, date('Y-m-d H:i:s') . ': ' . $query . PHP_EOL);
                fclose($logFile);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
