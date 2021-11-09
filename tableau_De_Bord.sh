#!/bin/sh
@echo off
echo laragon, please wait ...
start  laragon.exe
%laragon_root% \laragon reload 
start http://localhost/