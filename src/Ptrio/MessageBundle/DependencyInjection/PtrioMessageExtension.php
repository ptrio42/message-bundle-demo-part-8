<?php

namespace App\Ptrio\MessageBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PtrioMessageExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yaml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('ptrio_message.firebase.api_url', $config['firebase']['api_url']);
        $container->setParameter('ptrio_message.firebase.server_key', $config['firebase']['server_key']);

        $this->loadDevice($config['device'], $container);
        $this->loadMessage($config['message'], $container);
        $this->loadUser($config['user'], $container);
    }

    public function prepend(ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));
        $bundles = $container->getParameter('kernel.bundles');
        if (isset($bundles['DoctrineBundle'])) {
            $container
                ->loadFromExtension('doctrine', [
                    'orm' => [
                        'resolve_target_entities' => [
                            $config['device']['classes']['interface'] => $config['device']['classes']['model'],
                        ],
                    ],
                ])
            ;
        }
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function loadDevice(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ptrio_message.model.device.class', $config['classes']['model']);
//        $container->setParameter('ptrio_message.interface.device.class', $config['classes']['interface']);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function loadMessage(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ptrio_message.model.message.class', $config['classes']['model']);
        $container->setParameter('ptrio_message.interface.message.class', $config['classes']['interface']);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function loadUser(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ptrio_message.model.user.class', $config['classes']['model']);
        $container->setParameter('ptrio_message.interface.user.class', $config['classes']['interface']);
    }
}