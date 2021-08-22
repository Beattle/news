<?php

namespace App\Modules\NewsBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class PublishPostCommand extends Command
{

    function __construct(
        string $name = null
    )
    {

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Отложенная публикация статей')
            ->setName('app:set-publish');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Получаем список статей по статусу готовы к публикации и переводим в статус опубликовано


    }

}