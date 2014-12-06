require 'net/http'
require 'uri'

POST_API = 'http://localhost:9090/'

class MiniSensi
  attr_accessor :generators

  def initialize(generators)
    self.generators = generators
  end

  def _call_or_undef(sym)
    if self.generators[sym]
      self.generators[sym].respond_to?(:call) ? self.generators[sym].call() : self.generators[sym]
    else 
      nil
    end
  end

  def generate
    return {
      'Temperature' => _call_or_undef(:temperature) || 72,
      'Humidity' => _call_or_undef(:humidity) || 50,
      'PowerStatus' => _call_or_undef(:power_status) || 'battery',
      'BatteryVoltage' => _call_or_undef(:battery_voltage) || 3.2,
      'WifiConnectionQuality' => _call_or_undef(:wifi_connection_quality) || 35,
      'OperatingMode' => _call_or_undef(:operating_mode) || 'heat',
      'WorkingHeatSetpoint' => _call_or_undef(:working_heat_setpoint) || 62,
      'WorkingCoolSetpoint' => _call_or_undef(:working_cool_setpoint) || 78,
      'SystemStatus' => _call_or_undef(:system_status) || 'on',
      'Id' => _call_or_undef(:id) || 1,
      'Updated' => _call_or_undef(:updated) || Time.now().strftime("%F %T"),
    }
  end

  def post
    uri = URI(POST_API)
    return Net::HTTP.get(uri, generate())
    # return Net::HTTP.post_form(uri, construct_params())
  end
end

id_counter = 1
sensi_bin = []

poor_sensi = {
  :temperature => Proc.new { rand(32..60) },
  :working_heat_setpoint => Proc.new { rand(50..65) },
  :system_status => Proc.new { (['off'] * 3 + ['on']).sample }
}

medium_sensi = {
  :temperature => Proc.new { rand(60..72) },
  :working_heat_setpoint => Proc.new { rand(68..74) }
}

rich_sensi = {
  :temperature => Proc.new { rand(72..72) },
  :working_heat_setpoint => Proc.new { rand(70..72) }
}

(0..10).each {|n|
  sensi = poor_sensi.clone
  sensi[:id] = id_counter and id_counter += 1

  sensi_bin.push(MiniSensi.new(sensi))
}

(0..100).each {|n|
  sensi = medium_sensi.clone
  sensi[:id] = id_counter and id_counter += 1

  sensi_bin.push(MiniSensi.new(sensi))
}

(0..10).each {|n|
  sensi = rich_sensi.clone
  sensi[:id] = id_counter and id_counter += 1

  sensi_bin.push(MiniSensi.new(sensi))
}

puts '['
(0..100).each do
  puts sensi_bin.sample.generate.to_s + ","
end
puts ']'
