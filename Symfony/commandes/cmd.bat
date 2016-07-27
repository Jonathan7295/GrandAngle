@echo off
SCHTASKS /Create /SC DAILY /TN Oeuvre /TR C:\wamp\www\GrandAngle\Symfony\commandes\exec.bat /ST 01:10:00

