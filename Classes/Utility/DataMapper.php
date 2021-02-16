<?php
namespace StefanFroemken\Mysqlreport\Utility;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Simple DataMapper to map an array to object
 */
class DataMapper
{
    /**
     * @var \TYPO3\CMS\Extbase\Reflection\ReflectionService
     * @inject
     */
    protected $reflectionService;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Maps a single row on an object of the given class
     *
     * @param string $className The name of the target class
     * @param array $row A single array with field_name => value pairs
     * @return object An object of the given class
     */
    public function mapSingleRow($className, array $row)
    {
        if (class_exists($className)) {
            $object = $this->objectManager->get($className);
        } else return null;

        // loop through all properties
        foreach ($row as $propertyName => $value) {
            $propertyName = GeneralUtility::underscoredToLowerCamelCase($propertyName);
            $methodName = 'set' . ucfirst($propertyName);

            // if setter exists
            if (method_exists($object, $methodName)) {
                // get property type
                $propertyData = $this->reflectionService->getClassSchema($className)->getProperty($propertyName);
                switch ($propertyData['type']) {
                    case 'array':
                        $object->$methodName((array) $value);
                        break;
                    case 'int':
                    case 'integer':
                        $object->$methodName((int) $value);
                        break;
                    case 'bool':
                    case 'boolean':
                        $object->$methodName($value);
                        break;
                    case 'string':
                        $object->$methodName((string) $value);
                        break;
                    case 'float':
                        $object->$methodName((float) $value);
                        break;
                    case 'SplObjectStorage':
                    case 'Tx_Extbase_Persistence_ObjectStorage':
                    case 'TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage':
                        $object->$methodName($this->mapObjectStorage($propertyData['elementType'], $value));
                        break;
                    default:
                        if (class_exists($propertyData['type'])) {
                            $object->$methodName($this->mapSingleRow($propertyData['type'], $value));
                        }
                }
            }
        }
        return $object;
    }

    /**
     * map a object storage with given rows
     *
     * @param string $className
     * @param array $rows
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function mapObjectStorage($className, array $rows)
    {
        $objectStorage = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
        foreach ($rows as $row) {
            $objectStorage->attach($this->mapSingleRow($className, $row));
        }
        return $objectStorage;
    }
}
