<?php

/**
 * The nested resource controller can help you to avoid some boilerplate in nested resources in you rest api.
 *
 * If you have a resource `user` and the endpoint `/users` then a nested resource could be the friends of a specific
 * user. `/users/1/friends` is a possible endpoint for that. In every method you first need to check if the user with the
 * id 1 is available in the system.
 *
 * The friends controller can extend the nested resource rest controller and is now able to handle request in an easier
 * way.
 *
 * @author Christian Blank <c.blank@notthatbad.net>
 */
abstract class NestedResourceRestController extends BaseRestController {

    protected static $no_id_message = "No id provided.";
    protected static $no_id_error = 404;

    /**
     * @param SS_HTTPRequest $request
     * @param string $action
     * @return array
     * @throws RestSystemException
     * @throws RestUserException
     */
    public final function beforeCallActionHandler(SS_HTTPRequest $request, $action) {
        $id = $request->param(Config::inst()->get('NestedResourceRestController', 'root_resource_id_field'));
        if(!$id) {
            throw new RestUserException(static::$no_id_message, static::$no_id_message);
        }
        $resource = $this->getRootResource($id);
        if(!$resource) {
            SS_Log::log("NoResourceError was not handled inside the controller", SS_Log::WARN);
            throw new RestSystemException("NoResourceError was not handled inside the controller", 501);
        }
        return $this->$action($request, $resource);
    }

    /**
     *
     *
     * @param string $id the `ID` param in the request
     * @return mixed
     */
    protected abstract function getRootResource($id);

}
