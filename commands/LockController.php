<?php
namespace app\commands;

use yii\console\Controller;

use Yii;

abstract class LockController extends Controller
{
    const CATEGORY = 'lock';

    /**
     * Full path to lock file
     * @var string
     */
    protected $lockFile;

    /**
     * Returns path to lock file
     * You may override this method to do last-minute preparation for the action.
     * @return string
     */
    protected function getLockPath()
    {
        return Yii::$app->runtimePath;
    }

    /**
     * Returns lock filename
     * You may override this method to do last-minute preparation for the action.
     * @param string $action the action name
     * @return string
     */
    protected function getLockFilename($action)
    {
        return $this->id . '-' . strtolower($action->id) . '.lock';
    }

    public function beforeAction($action)
    {
        $this->lockFile = $this->getLockPath() . DIRECTORY_SEPARATOR . $this->getLockFilename($action);
        if ($this->isLocked()) {
            Yii::warning("Action was canceled because it's locked now", self::CATEGORY);
            return false;
        }
        Yii::trace("Lock before action", self::CATEGORY);
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        Yii::trace("Unlock after action", self::CATEGORY);
        unlink($this->lockFile);
        parent::afterAction($action, $result);
    }

    /**
     * If lock file exists, check if stale.  If exists and is not stale, return TRUE
     * Else, create lock file and return FALSE.
     * @return boolean
     */
    protected function isLocked()
    {
        if (file_exists($this->lockFile)) {

            // Check if it's stale
            $lockingPID = trim(file_get_contents($this->lockFile));
            // Get all active PIDs.
            $pids = explode("\n", trim(`ps -e | awk '{print $1}'`));
            // If PID is still active, return true
            if (in_array($lockingPID, $pids)) {
                return true;
            }
            // Lock-file is stale, so kill it.  Then move on to re-creating it.
            Yii::warning("Removing stale lock file " . $this->lockFile, self::CATEGORY);
            unlink($this->lockFile);
        }

        file_put_contents($this->lockFile, getmypid() . "\n");
        return false;
    }
}