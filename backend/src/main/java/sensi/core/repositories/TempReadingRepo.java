package sensi.core.repositories;

import sensi.core.models.entities.TempReading;

import java.time.LocalTime;
import java.util.List;

/**
 * Created by Scott on 12/6/2014.
 */
public interface TempReadingRepo {

    public List<TempReading> findAllTemps();

    public TempReading findTemp( Long id );

    public List<TempReading> findTempByUnit( Long id );

    public List<TempReading> findTempByRange( int top, int bottom );

    public TempReading addTemp( TempReading tempReading);

    public List<TempReading> findTempByTimeRange( LocalTime start, LocalTime finish );
}
