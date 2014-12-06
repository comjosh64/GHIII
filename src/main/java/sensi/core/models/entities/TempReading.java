package sensi.core.models.entities;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import java.time.LocalTime;

/**
 * Created by Scott on 12/6/2014.
 */

@Entity
public class TempReading {

    @Id @GeneratedValue
    private Long rowId;

    private Long unitId;

    private double value;

    private int targetHeat;

    private int targetCool;

    private LocalTime lastUpdated;

    public int getTargetHeat() {
        return targetHeat;
    }

    public void setTargetHeat(int targetHeat) {
        this.targetHeat = targetHeat;
    }

    public int getTargetCool() {
        return targetCool;
    }

    public void setTargetCool(int targetCool) {
        this.targetCool = targetCool;
    }

    public Long getUnitId() {
        return unitId;
    }

    public void setUnitId(Long unitId) {
        this.unitId = unitId;
    }

    public Long getRowIdId() {
        return rowId;
    }

    public void setRowId(Long id) {
        rowId = id;
    }

    public double getValue() {
        return value;
    }

    public void setValue(double value) {
        this.value = value;
    }

    public LocalTime getLastUpdated() {
        return lastUpdated;
    }

    public void setLastUpdated(LocalTime lastUpdated) {
        this.lastUpdated = lastUpdated;
    }
}
