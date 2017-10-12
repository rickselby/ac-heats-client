<?php

/**
 * Override exec() for the Services namespace
 */
namespace App\Services {
    function exec($command, array &$output = null, &$return_var = null) {
        $output = $command;
    }
}

namespace RickSelby\Tests\Script {

    use App\Services\ScriptService;
    use RickSelby\Tests\BaseSetup;

    class ScriptTest extends BaseSetup
    {
        /** @var ScriptService */
        protected $scriptService;

        const command='/path/to/cmd';

        public function setUp()
        {
            parent::setUp();
            putenv('AC_SERVER_SCRIPT='.self::command);
            $this->scriptService = new ScriptService();
        }

        /**
         * Test that run() runs the AC_SERVER_SCRIPT command correctly
         */
        public function testExec()
        {
            $command = 'foo bar';
            $this->assertEquals(
                self::command.' '.$command,
                $this->scriptService->run($command)
            );
        }
    }
}