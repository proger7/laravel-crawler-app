<?php declare(strict_types = 1);

namespace OndraM\CiDetector\Ci;

use OndraM\CiDetector\CiDetector;
use OndraM\CiDetector\Env;

class Travis extends AbstractCi
{
    const TRAVIS_BASE_URL = 'https://travis-ci.org';

    public static function isDetected(Env $env): bool
    {
        return $env->get('TRAVIS') !== false;
    }

    public function getCiName(): string
    {
        return CiDetector::CI_TRAVIS;
    }

    public function getBuildNumber(): string
    {
        return $this->env->getString('TRAVIS_JOB_NUMBER');
    }

    public function getBuildUrl(): string
    {
        return sprintf(
            '%s/%s/jobs/%s',
            self::TRAVIS_BASE_URL,
            $this->env->get('TRAVIS_REPO_SLUG'),
            $this->env->get('TRAVIS_JOB_ID')
        );
    }

    public function getGitCommit(): string
    {
        return $this->env->getString('TRAVIS_COMMIT');
    }

    public function getGitBranch(): string
    {
        if ($this->env->getString('TRAVIS_PULL_REQUEST') === 'false') {
            return $this->env->getString('TRAVIS_BRANCH');
        }

        // If the build is for PR, return name of the branch with the PR, not the target PR branch
        // https://github.com/travis-ci/travis-ci/issues/6652
        return $this->env->getString('TRAVIS_PULL_REQUEST_BRANCH');
    }

    public function getRepositoryUrl(): string
    {
        return ''; // unsupported
    }
}
