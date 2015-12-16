<?php

namespace Http\Promise;

use Psr\Http\Message\ResponseInterface;

/**
 * Promise represents a value that may not be available yet, but will be resolved at some point in future.
 * It acts like a proxy to the actual value.
 *
 * This interface is an extension of the promises/a+ specification.
 * @see https://promisesaplus.com/
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Promise
{
    /**
     * Promise has not been fulfilled or rejected.
     */
    const PENDING = 'pending';

    /**
     * Promise has been fulfilled.
     */
    const FULFILLED = 'fulfilled';

    /**
     * Promise has been rejected.
     */
    const REJECTED = 'rejected';

    /**
     * Adds behavior for when the promise is resolved or rejected (response will be available, or error happens).
     *
     * If you do not care about one of the cases, you can set the corresponding callable to null
     * The callback will be called when the value arrived and never more than once.
     *
     * @param callable $onFulfilled Called when a response will be available.
     * @param callable $onRejected  Called when an error happens.
     *
     * @return Promise A new resolved promise with value of the executed callback (onFulfilled / onRejected).
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null);

    /**
     * Returns the state of the promise, one of PENDING, FULFILLED or REJECTED.
     *
     * @return string
     */
    public function getState();

    /**
     * Wait for the promise to be fulfilled or rejected.
     *
     * When this method returns, the request has been resolved and the appropriate callable has terminated.
     *
     * When called with the unwrap option
     *
     * @param bool $unwrap Whether to return resolved value / throw reason or not
     *
     * @return ResponseInterface|null Resolved value, null if $unwrap is set to false
     *
     * @throws \Http\Client\Exception The rejection reason.
     */
    public function wait($unwrap = true);
}
