package sensi.core.services;

import sensi.core.models.entities.TempReading;
import sensi.core.services.util.TempReadingList;

import java.time.LocalTime;
import java.util.List;

/**
 * Created by Scott on 12/6/2014.
 */
public interface TempReadingService {

    public TempReadingList findAllTemps();

    public TempReading findTemp( Long id );

    public TempReadingList findTempByUnit( Long id );

    public TempReadingList findTempByRange( int top, int bottom );

    public TempReading addTemp( TempReading tempReading);

    public TempReadingList findTempByTimeRange( LocalTime start, LocalTime finish );
}
