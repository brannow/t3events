<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "t3events".
 *
 * Auto generated 05-02-2018 18:13
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Events',
    'description' => 'Manage events, show teasers, list and single views.',
    'category' => 'plugin',
    'version' => '2.0.0',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearcacheonload' => 0,
    'author' => 'Dirk Wenzel, Michael Kasten',
    'author_email' => 't3events@gmx.de, kasten@webfox01.de',
    'author_company' => 'Agentur Webfox GmbH, Consulting Piezunka Schamoni - Information Technologies GmbH',
    'constraints' =>
        array(
            'depends' =>
                array(
                    'typo3' => '11.5.00-11.9.99',
                    't3extension_tools' => '1.0.0-2.99.99'
                ),
            'conflicts' =>
                array(),
            'suggests' =>
                array(),
        )
);

