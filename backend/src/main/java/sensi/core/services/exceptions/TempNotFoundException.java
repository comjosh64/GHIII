package sensi.core.services.exceptions;

/**
 * Created by Scott on 12/6/2014.
 */
public class TempNotFoundException extends RuntimeException{
    public TempNotFoundException(String message, Throwable cause, boolean enableSuppression, boolean writableStackTrace) {
        super(message, cause, enableSuppression, writableStackTrace);
    }

    public TempNotFoundException() {
    }

    public TempNotFoundException(String message) {
        super(message);
    }

    public TempNotFoundException(String message, Throwable cause) {
        super(message, cause);
    }

    public TempNotFoundException(Throwable cause) {
        super(cause);
    }
}
