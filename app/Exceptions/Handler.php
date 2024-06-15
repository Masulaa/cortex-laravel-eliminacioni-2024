public function render($request, Throwable $exception)
{
    if ($this->isHttpException($exception)) {
        if ($exception->getStatusCode() == 404) {
            return response()->view('errors.404', [], 404);
        }
    }
    return parent::render($request, $exception);
}
