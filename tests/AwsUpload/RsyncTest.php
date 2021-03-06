<?php

namespace AwsUpload\Tests;

use AwsUpload\Rsync;
use AwsUpload\Tests\BaseTestCase;

class RsyncTest extends BaseTestCase
{

    public function test_new_string_exception()
    {
        $this->expectException(\Exception::class);
        $rsync = new Rsync('');
    }

    public function test_new_array_exception()
    {
        $this->expectException(\Exception::class);
        $rsync = new Rsync(array());
    }

    public function test_buildCmd_object_true()
    {
        $cmd = 'rsync -ravze "ssh -i /Users/jhon.doe/Documents/certificates/site.pem"  --exclude \'.env\'  '
             . '--exclude \'.git/\'  --exclude .DS_Store /Users/jhon.doe/Documents/w/html/ '
             . '\'ec2-user@ec2-xx-xx-xx-xx.ap-southeast-2.compute.amazonaws.com:/var/www/html/site\'';

        $setting = (object) array(
            "pem" => "/Users/jhon.doe/Documents/certificates/site.pem",
            "local" => "/Users/jhon.doe/Documents/w/html/",
            "remote" => "ec2-user@ec2-xx-xx-xx-xx.ap-southeast-2.compute.amazonaws.com:" .
                        "/var/www/html/site",
            "exclude" => array (
                    ".env",
                    ".git/"
                )
        );
        $rsync = new Rsync($setting);
        $this->assertEquals($rsync->cmd, $cmd);
    }
}
