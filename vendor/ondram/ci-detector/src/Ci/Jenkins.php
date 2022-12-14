<?php declare(strict_types = 1);

namespace OndraM\CiDetector\Ci;

use OndraM\CiDetector\CiDetector;
use OndraM\CiDetector\Env;

class Jenkins extends AbstractCi
{
    public static function isDetected(Env $env): bool
    {
        return $env->get('JENKINS_URL') !== false;
    }

    public function getCiName(): string
    {
        return CiDetector::CI_JENKINS;
    }

    public function getBuildNumber(): string
    {
        return $this->env->getString('BUILD_NUMBER');
    }

    public function getBuildUrl(): string
    {
        return $this->env->getString('BUILD_URL');
    }

    public function getGitCommit(): string
    {
        return $this->env->getString('GIT_COMMIT');
    }

    public function getGitBranch(): string
    {
        return $this->env->getString('GIT_BRANCH');
    }

    public function getRepositoryUrl(): string
    {
        return $this->env->getString('GIT_URL');
    }
}
