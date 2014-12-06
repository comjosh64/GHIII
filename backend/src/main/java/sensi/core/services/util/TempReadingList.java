package sensi.core.services.util;

import sensi.core.models.entities.TempReading;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Scott on 12/6/2014.
 */
public class TempReadingList {

    private List temps = new ArrayList<TempReading>();

    public TempReadingList(List temps) {
        this.temps = temps;
    }

    public List getTemps() {
        return temps;
    }

    public void setTemps(List temps) {
        this.temps = temps;
    }
}
