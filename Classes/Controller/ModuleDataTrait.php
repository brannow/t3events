<?php
namespace DWenzel\T3events\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use DWenzel\T3events\Domain\Model\Dto\ModuleData;
use DWenzel\T3events\Service\ModuleDataStorageService;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

/**
 * Class ModuleDataTrait
 * Provides functionality for backend module controller
 *
 * @package DWenzel\T3events\Controller
 */
trait ModuleDataTrait
{
    /**
     * @var ModuleData
     */
    protected ModuleData $moduleData;

    /**
     * @var ModuleDataStorageService
     */
    protected ModuleDataStorageService $moduleDataStorageService;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @return array
     */
    abstract public function mergeSettings();

    /**
     * @return string
     */
    abstract public function getModuleKey();

    /**
     * Forwards the request to another action and / or controller.
     * Request is directly transfered to the other action / controller
     * without the need for a new request.
     *
     * @param string $actionName Name of the action to forward to
     * @param string $controllerName Unqualified object name of the controller to forward to. If not specified, the current controller is used.
     * @param string $extensionName Name of the extension containing the controller to forward to. If not specified, the current extension is assumed.
     * @param array $arguments Arguments to pass to the target action
     * @return void
     */
    abstract public function forward(
        $actionName,
        $controllerName = null,
        $extensionName = null,
        array $arguments = null
    );

    public function processRequest(RequestInterface $request): ResponseInterface
    {
        $this->moduleData = $this->moduleDataStorageService->loadModuleData($this->getModuleKey());

        try {
            $response = parent::processRequest($request);
            $this->moduleDataStorageService->persistModuleData($this->moduleData, $this->getModuleKey());
        } catch (\Exception $e) {
            $this->moduleDataStorageService->persistModuleData($this->moduleData, $this->getModuleKey());
            throw $e;
        }

        return $response;
    }

    /**
     * initializes all action methods
     */
    public function initializeAction()
    {
        $this->pageUid = (int)GeneralUtility::_GET('id');
        $this->settings = $this->mergeSettings();
    }

    /**
     * Reset action
     * Resets all module data and forwards the request to the list action
     */
    public function resetAction()
    {
        $this->moduleData =GeneralUtility::makeInstance(ModuleData::class);
        $this->moduleDataStorageService->persistModuleData($this->moduleData, $this->getModuleKey());
        $this->forward('list');
    }

    /**
     * @return ModuleData
     */
    public function getModuleData()
    {
        return $this->moduleData;
    }

    /**
     * @param ModuleData $moduleData
     */
    public function setModuleData(ModuleData $moduleData)
    {
        $this->moduleData = $moduleData;
    }

}
