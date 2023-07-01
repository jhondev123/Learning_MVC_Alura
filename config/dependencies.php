
<?php
  /** @var \Psr\Container\ContainerInterface $container */
$biulder = new \DI\ContainerBuilder();
$biulder->addDefinitions([
   PDO::class => function():PDO{
       $pdo = ConnectionCreator::createConnection();
    return $pdo;
   },
    \League\Plates\Engine::class => function () {
        $templatePath = __DIR__ . '/../views';
        return new League\Plates\Engine($templatePath);
    }
]);
$container = $biulder->build();

    return $container;

