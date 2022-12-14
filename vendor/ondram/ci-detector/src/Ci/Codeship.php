<?php declare(strict_types = 1);

namespace OndraM\CiDetector\Ci;

use OndraM\CiDetector\CiDetector;
use OndraM\CiDetector\Env;

class Codeship extends AbstractCi
{
    public static function isDetected(Env $env): bool
    {
        return $env->get('CI_NAME') === 'codeship';
    }

    public function getCiName(): string
    {
        return CiDetector::CI_CODESHIP;
    }

    public function getBuildNumber(): string
    {
        return $this->env->getString('CI_BUILD_NUMBER');
    }

    public function getBuildUrl(): string
    {
        return $this->env->getString('CI_BUILD_URL');
    }

    public function getGitCommit(): string
    {
        return $this->env->getString('COMMIT_ID');
    }

    public function getGitBranch(): string
    {
        return $this->env->getString('CI_BRANCH');
    }

    public function getRepositoryUrl(): string
    {
        return ''; // unsupported
    }
}
