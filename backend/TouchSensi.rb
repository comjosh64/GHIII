require 'rubygems'
require 'sinatra'
require './MiniSensi.rb'
require 'json'

set :protection, false

options '/submit' do
  response['Access-Control-Allow-Origin'] = 'http://localhost'
  response['Access-Control-Allow-Credentials'] = 'true'
  response['Access-Control-Allow-Methods'] = ['GET', 'PUT']
  return response
end

put '/submit' do
  puts params

  params['id'] = {
    '36-6f-92-ff-fe-01-39-e9' => 1,
  }[params['']]

  mini_sensi = MiniSensi.new(:temperature => Integer(params['temperature']), :id => params['id'])

  File.open("/home/dummey/Documents/GHIII/backendUI/test/update-#{params['id']}.json", 'w+') { |file| file.write(mini_sensi.generate.to_json) }

  response['Access-Control-Allow-Origin'] = 'http://localhost'
  response['Access-Control-Allow-Credentials'] = 'true'
  response['Access-Control-Allow-Methods'] = ['GET', 'PUT']
  return response
end

options '/submit_batch' do
  response['Access-Control-Allow-Origin'] = 'http://localhost'
  response['Access-Control-Allow-Credentials'] = 'true'
  response['Access-Control-Allow-Methods'] = ['GET', 'PUT']
  return response
end

put '/submit_batch' do
  puts params

  sensi_set = [];
  params.each{ |k,v| 
    sensi_set.push(MiniSensi.new(:temperature => Integer(v), :id => k))
  }

  json = (sensi_set.map{|s| s.generate }).to_json

  File.open("/home/dummey/Documents/GHIII/backendUI/test/manual-update.json", 'w+') { |file| file.write(json) }

  response['Access-Control-Allow-Origin'] = 'http://localhost'
  response['Access-Control-Allow-Credentials'] = 'true'
  response['Access-Control-Allow-Methods'] = ['GET', 'PUT']
  return response
end